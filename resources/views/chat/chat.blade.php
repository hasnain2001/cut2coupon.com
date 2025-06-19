@extends('chat.app')
@section('title', 'Chat with ' . $otherUser->name)
@section('styles')
<link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.12.0/dist/index.min.css" rel="stylesheet">
<style>
    /* Chat container styling */
    .chat-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .chat-card {
        height: 80vh;
        display: flex;
        flex-direction: column;
    }
    
    .chat-header {
        background-color: #4e73df;
        color: white;
        padding: 15px;
        border-radius: 5px 5px 0 0 !important;
    }
    
    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background-color: #f8f9fc;
    }
    
    .chat-footer {
        padding: 15px;
        background-color: #fff;
        border-top: 1px solid #e3e6f0;
    }
    
    /* Messages styling */
    .messages {
        height: 100%;
        overflow-y: auto;
        padding: 10px;
    }
    
    .message {
        margin-bottom: 15px;
        max-width: 70%;
        clear: both;
    }
    
    .message-content {
        padding: 10px 15px;
        border-radius: 18px;
        position: relative;
        word-wrap: break-word;
    }
    
    .sent {
        float: right;
    }
    
    .sent .message-content {
        background-color: #4e73df;
        color: white;
        border-bottom-right-radius: 0;
    }
    
    .received {
        float: left;
    }
    
    .received .message-content {
        background-color: #e9ecef;
        color: #212529;
        border-bottom-left-radius: 0;
    }
    
    .message-sender {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 0.8rem;
    }
    
    .message-time {
        font-size: 0.7rem;
        text-align: right;
        margin-top: 5px;
        opacity: 0.7;
    }
    
    /* Input area styling */
    .chat-input {
        border-radius: 20px;
        padding: 10px 15px;
        border: 1px solid #d1d3e2;
    }
    
    .btn-send {
        background-color: #4e73df;
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-icon {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 1.2rem;
        padding: 5px 10px;
    }
    
    .btn-icon:hover {
        color: #4e73df;
    }
    
    /* File preview styling */
    #file-preview {
        background-color: #f8f9fa;
        padding: 5px 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }
    
    /* Emoji picker styling */
    emoji-picker {
        --emoji-size: 1.5rem;
        --num-columns: 8;
        --category-emoji-size: 1.5rem;
        --background: #fff;
        --border-color: #ddd;
        --button-active-background: #eee;
        --input-border-color: #ddd;
        --input-font-size: 1rem;
        position: absolute;
        bottom: 60px;
        right: 20px;
        z-index: 1000;
        display: none;
    }
    
    .img-thumbnail {
        max-width: 200px;
        max-height: 200px;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="container chat-container">
    <div class="row">
        <div class="col-md-12">
            <div class="card chat-card">
                <div class="card-header chat-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-comments mr-2"></i>
                        <span>Chat with {{ $otherUser->name }}</span>
                    </div>
                    <div class="chat-status">
                        <span class="badge badge-pill badge-success">Online</span>
                    </div>
                </div>
                
                <div class="card-body chat-body">
                    <div class="messages" id="messages">
                        @foreach($messages as $message)
                        <div class="message @if($message->sender_id == auth()->id()) sent @else received @endif" data-message-id="{{ $message->id }}">
                            <div class="message-content">
                                @if($message->sender_id != auth()->id())
                                <div class="message-sender">{{ $message->sender->name }}</div>
                                @endif
                                <div class="message-text">
                                    @if($message->file_path)
                                        @if(strpos($message->file_type, 'image/') === 0)
                                            <img src="{{ asset('storage/' . $message->file_path) }}" class="img-thumbnail">
                                        @else
                                            <a href="{{ asset('storage/' . $message->file_path) }}" download>
                                                <i class="fas fa-file"></i> Download File
                                            </a>
                                        @endif
                                    @endif
                                    {{ $message->message }}
                                </div>
                                <div class="message-time">{{ $message->created_at->timezone('Asia/Karachi')->format('h:i A') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="card-footer chat-footer">
                    <form action="{{ route('chat.send') }}" method="POST" id="message-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $userId }}" id="receiver_id">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control chat-input" 
                                   placeholder="Type your message..." id="message-input"
                                   autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-send" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chat-actions mt-2">
                            <button type="button" class="btn btn-icon" title="Attach file" id="attach-file-btn">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <input type="file" id="file-input" name="file" style="display: none;" accept="image/*, .pdf, .doc, .docx, .txt">
                            <button type="button" class="btn btn-icon" title="Emoji" id="emoji-btn">
                                <i class="far fa-smile"></i>
                            </button>
                            <div id="file-preview" class="mt-2" style="display: none;">
                                <span id="file-name"></span>
                                <button type="button" id="remove-file" class="btn btn-sm btn-danger ml-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <emoji-picker id="emoji-picker"></emoji-picker>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.12.0/dist/index.min.js"></script>
<script>
$(document).ready(function() {
    // Auto-scroll to bottom of messages
    $('#messages').scrollTop($('#messages')[0].scrollHeight);
    
    // Initialize emoji picker
    const picker = document.getElementById('emoji-picker');
    const emojiBtn = document.getElementById('emoji-btn');
    const messageInput = document.getElementById('message-input');
    
    emojiBtn.addEventListener('click', () => {
        picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
    });
    
    picker.addEventListener('emoji-click', event => {
        messageInput.value += event.detail.unicode;
        picker.style.display = 'none';
    });
    
    // Close picker when clicking outside
    document.addEventListener('click', (e) => {
        if (!picker.contains(e.target) && e.target !== emojiBtn) {
            picker.style.display = 'none';
        }
    });
    
    // File upload functionality
    const fileInput = document.getElementById('file-input');
    const attachBtn = document.getElementById('attach-file-btn');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const removeFileBtn = document.getElementById('remove-file');
    
    attachBtn.addEventListener('click', () => {
        fileInput.click();
    });
    
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            fileName.textContent = file.name;
            filePreview.style.display = 'flex';
        }
    });
    
    removeFileBtn.addEventListener('click', () => {
        fileInput.value = '';
        filePreview.style.display = 'none';
    });
    
    // Function to fetch new messages
    function fetchNewMessages() {
        var lastMessageId = $('.message').last().data('message-id') || 0;
        var receiverId = $('#receiver_id').val();
        
        if (!receiverId) return;
        
        $.ajax({
            url: "{{ route('chat.get-new-messages') }}",
            type: "GET",
            data: {
                receiver_id: receiverId,
                last_message_id: lastMessageId
            },
            success: function(response) {
                if (response.messages && response.messages.length > 0) {
                    response.messages.forEach(function(message) {
                        if (message.sender_id != {{ auth()->id() }}) {
                            var time = new Date(message.created_at).toLocaleTimeString([], { 
                                hour: '2-digit', 
                                minute: '2-digit' 
                            });
                            
                            var messageContent = message.message;
                            var fileContent = '';
                            
                            if (message.file_path) {
                                if (message.file_type.startsWith('image/')) {
                                    fileContent = `<img src="/storage/${message.file_path}" class="img-thumbnail">`;
                                } else {
                                    fileContent = `<a href="/storage/${message.file_path}" download>
                                        <i class="fas fa-file"></i> Download File
                                    </a>`;
                                }
                            }
                            
                            $('#messages').append(`
                                <div class="message received" data-message-id="${message.id}">
                                    <div class="message-content">
                                        <div class="message-sender">${message.sender.name}</div>
                                        <div class="message-text">
                                            ${fileContent}
                                            ${messageContent}
                                        </div>
                                        <div class="message-time">${time}</div>
                                    </div>
                                </div>
                            `);
                        }
                    });
                    $('#messages').scrollTop($('#messages')[0].scrollHeight);
                }
            }
        });
    }
    
    // Check for new messages every 3 seconds
    setInterval(fetchNewMessages, 3000);
    
    // Form submission
    $('#message-form').submit(function(e) {
        e.preventDefault();
        
        var message = $('#message-input').val().trim();
        var file = $('#file-input')[0].files[0];
        
        if(message === '' && !file) return;
        
        var receiverId = $('#receiver_id').val();
        var token = $('input[name="_token"]').val();
        var timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        // Create FormData object for file upload
        var formData = new FormData(this);
        
        // Add message immediately to UI (optimistic update)
        if (file) {
            // Handle file preview in chat
            if (file.type.startsWith('image/')) {
                $('#messages').append(`
                    <div class="message sent">
                        <div class="message-content">
                            <div class="message-text">
                                <img src="${URL.createObjectURL(file)}" class="img-thumbnail">
                                ${message}
                            </div>
                            <div class="message-time">${timestamp}</div>
                        </div>
                    </div>
                `);
            } else {
                $('#messages').append(`
                    <div class="message sent">
                        <div class="message-content">
                            <div class="message-text">
                                <i class="fas fa-file"></i> ${file.name}
                                ${message}
                            </div>
                            <div class="message-time">${timestamp}</div>
                        </div>
                    </div>
                `);
            }
        } else if (message) {
            $('#messages').append(`
                <div class="message sent">
                    <div class="message-content">
                        <div class="message-text">${message}</div>
                        <div class="message-time">${timestamp}</div>
                    </div>
                </div>
            `);
        }
        
        // Clear inputs
        $('#message-input').val('');
        $('#file-input').val('');
        filePreview.style.display = 'none';
        
        // Scroll to bottom
        $('#messages').scrollTop($('#messages')[0].scrollHeight);
        
        // Send to server
        $.ajax({
            url: "{{ route('chat.send') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.message_id) {
                    $('.message').last().attr('data-message-id', response.message_id);
                }
            },
            error: function(xhr) {
                alert('Message failed to send. Please try again.');
            }
        });
    });
});
</script>
@endsection