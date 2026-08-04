@extends('user.user-master')
@push('styles')
    <style>
        /* EXHIBITOR REGISTRATION */

        .ex-reg-sec {

            padding: 4em 0;
        }

        .ex-reg-blk button {

            padding: 10px 14px;
            background-color: #243546;
            ;
            display: block;
            width: 100%;
            border-radius: 6px;
            border: 1px solid #243546;
            ;
            color: #fff;
            margin-top: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: var(--text-font);
        }

        .ex-reg-blk button:hover {

            background-color: transparent;
            border: 1px solid #243546;
            ;
            color: #243546;
            ;
        }

        .reg-img img {
            width: 100%;
            max-height: 600px;
            object-fit: contain;
        }

        .ms-align {
            align-items: center;
            display: flex;
        }
    </style>
@endpush
@section('content')
    <main>

        <section class="ex-reg-sec">
            <div class="container">
                <div class="row ms-align">
                    <div class="col-md-12 col-lg-5">
                        <div class="reg-img">
                            <img src="{{ asset('assets/logo/logo3.png') }}" alt="masters">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-7">
                        <div class="ex-reg-blk">
                            <form action="/exhibitors-register" action="post" id="exhibitForm">
                                @csrf
                                <input type="hidden" name="company_id" value="58">
                                <div class="row">
                                    <div class=" col-lg-12">
                                        <div class="form-input">
                                            <input type="text" placeholder="Name" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="text" placeholder="Designation" name="designation" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-input">
                                            <input type="text" placeholder="Company Name" name="firm_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-input">
                                            <input type="number" placeholder="Mobile Number" name="mobile" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-input">
                                            <input type="email" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-input">
                                            <input type="text" placeholder="Address" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-input">
                                            <input type="number" placeholder="Pin code" name="pincode" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <input type="text" placeholder="City" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <input type="text" placeholder="State" name="state" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <input type="text" placeholder="Country" name="country" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit">
                                    <p>Register</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#exhibitForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                //ajax header
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(data) {
                        alert(data);
                        form.trigger('reset');
                    }
                });
            });
        })
    </script>
@endsection
