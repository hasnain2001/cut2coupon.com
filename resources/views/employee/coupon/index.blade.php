@extends('employee.layouts.master')
@section('title', 'Coupon List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title text-white mb-0">
                            <i class="fas fa-tags me-2"></i> Coupon Management
                        </h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('employee.coupon.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus-circle me-1"></i> Add Coupon
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-3">
                        <form method="GET" action="{{ route('employee.coupon.index') }}">
                            <div class="input-group">
                                <label class="input-group-text bg-light"><i class="fas fa-store"></i></label>
                                <select name="store_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">All Stores</option>
                                    @foreach ($couponstore as $store)
                                        <option value="{{ $store->store->id }}" {{ $selectedCoupon == $store->store->id ? 'selected' : '' }}>
                                            {{ $store->store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 ms-auto text-end">
                        <button class="btn btn-danger btn-sm" id="deleteSelected">
                            <i class="fas fa-trash-alt me-1"></i> Delete Selected
                        </button>
                    </div>
                </div>

                <!-- Main delete form -->
                <form id="deleteSelectedForm" action="{{ route('employee.coupon.deleteSelected') }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>

                <div class="table-responsive">
                    <table id="couponsTable" class="table table-hover table-bordered w-100">
                        <thead class="table-light">
                            <tr>
                                <th width="20px">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th width="50px">ID</th>
                                <th width="50px">Sort</th>
                                <th>Coupon Name</th>
                                <th>Store</th>
                                <th width="100px">Type</th>
                                <th width="100px">Status</th>
                                <th width="120px">Created At</th>
                                <th width="120px">Updated At</th>
                                <th width="120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents">
                            @foreach ($coupons as $coupon)
                            <tr class="row1" data-id="{{ $coupon->id }}">
                                <td>
                                    <input form="deleteSelectedForm" type="checkbox" class="select-checkbox" name="ids[]" value="{{ $coupon->id }}">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center handle" style="cursor: move;">
                                    <i class="fas fa-arrows-alt text-muted"></i>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">

                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    {{ substr($coupon->name, 0, 1) }}
                                                </span>
                                            </div>

                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">{{ $coupon->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $coupon->code ?? 'Deal' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">
                                        {{ $coupon->store->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($coupon->code)
                                        <span class="badge bg-primary"><i class="fas fa-code me-1"></i> Code</span>
                                    @else
                                        <span class="badge bg-success"><i class="fas fa-percentage me-1"></i> Deal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($coupon->status == 1)
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Active</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i> Inactive</span>
                                    @endif
                                </td>
                           
                                <td>{{ $coupon->created_at->format('d M Y') }}</td>
                                <td>{{ $coupon->updated_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('employee.coupon.edit', $coupon->id) }}" class="btn btn-sm btn-soft-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employee.coupon.destroy', $coupon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure to delete this coupon?')" class="btn btn-sm btn-soft-danger" data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
