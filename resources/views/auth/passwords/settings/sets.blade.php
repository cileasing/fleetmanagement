@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-condensed">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Table Name</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            print_r($tables);
                                        ?>
                                        @foreach($tables as $trans)

                                        <tr>

                                            
                                           

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                </div>
                                <!-- END OF POP UP BOX -->


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
