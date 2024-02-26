@extends('layouts.main')
@section('content')
<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ Invoice ] start -->
    <div class="container" id="printTable">
        <div>
                <div class="card">
                    <div class="card-header">
                        <p class="text-green-800 font-bold text-xl">Update My information</p>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-maximize"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="py-2">
                            <div class="max-w-7xl mx-auto sm:px-2">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="flex flex-col">
                                        <div class="w-full">
                                            <div class="mt-10 sm:mt-0">
                                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                                    <div class="md:col-span-1">
                                                        <div class="px-4 sm:px-0">
                                                            @include('layouts.flash')
                                                            <h3 class="text-lg font-bold leading-6 text-green-700">User Information</h3>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                Edit {{ auth()->user()->name }} Information
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 md:mt-0 md:col-span-2">
                                                        <form action="{{ route('update.profile') }}" method="post">
                                                            @csrf
                                                            @method('patch')
                                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                                    <div class="grid grid-cols-6 gap-6">
                                                                        <div class="col-span-6 sm:col-span-3">
                                                                            <label for="first_name" class="block text-sm font-bold text-green-800 ">Job Title</label>
                                                                            <input type="text" name="name" class="form-control mt-1 btn-green" value="{{ auth()->user()->name }}">
                                                                        </div>

                                                                        <div class="col-span-6 sm:col-span-3">
                                                                            <label for="last_name" class="block text-sm font-bold text-green-800 ">Email</label>
                                                                            <input type="text" name="email" readonly class="form-control mt-1 btn-green" value="{{ auth()->user()->email }}">
                                                                        </div>

                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="state" class="block text-sm font-bold text-green-800 ">Site</label>
                                                                            <select id="site" class="form-control" name="site" required>
                                                                                <option value="{{ auth()->user()->site }}">{{ auth()->user()->site }}</option>
                                                                                <option value="Head Office">Head Office</option>
                                                                                <option value="Kiambere">Kiambere</option>
                                                                                <option value="Dokolo">Dokolo</option>
                                                                                <option value="Nyongoro">Nyongoro</option>
                                                                                <option value="7 Forks">7 Forks</option>
                                                                                <option value="Sosoma">Sosoma</option>
                                                                                <option value="Kampala">Kampala</option>
                                                                                <option value="Tanzania">Tanzania</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="postal_code" class="block text-sm font-bold text-green-800 ">Department</label>
                                                                            <select class="form-control" name="department" required>
                                                                                <option value="{{ auth()->user()->department }}">{{ auth()->user()->department }}</option>
                                                                                <option value="IT">IT</option>
                                                                                <option value="Accounts">Accounts </option>
                                                                                <option value="HR">HR</option>
                                                                                <option value="Communications">Communications</option>
                                                                                <option value="Forestry">Forestry</option>
                                                                                <option value="Miti Magazines">Miti Magazine</option>
                                                                                <option value="Operations">Operations</option>
                                                                                <option value="M&E">M&E</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="postal_code" class="block text-sm font-bold text-green-800 ">Supervisor Email</label>
                                                                            <input type="text" name="supervisor" class="form-control mt-1 btn-green" value="{{ auth()->user()->supervisor }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                                    <Button class="btn btn-primary btn-sm rounded-md" type="submit">
                                                                        Save
                                                                    </Button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
    <!-- [ Invoice ] end -->
</div>
<!-- [ Main Content ] end -->

@endsection