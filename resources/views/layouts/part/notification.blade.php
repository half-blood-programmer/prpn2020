@if ($message = Session::get('success'))
                                <div class="alert alert-warning alert-block animate alert-dismissible fade show" data-animate="fadeInUp" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block animate alert-dismissible fade show" data-animate="fadeInUp" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($errors->any())
                                    <div class="text-left alert alert-danger alert-block animate alert-dismissible fade show" data-animate="fadeInUp" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li><strong>{{ $error }}</strong></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif