<!DOCTYPE html>
<html lang="en">

@include('partials.header')

<body class="bg-primary">

    <div id="layoutAuthentication">

        <div id="layoutAuthentication_content">

            <main>

                <div class="container">

                    <div class="row justify-content-center">

                        <div class="col-lg-5">

                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">
                                        Student Information
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <form>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['id'] }}"
                                                readonly
                                            />
                                            <label>Student ID</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['Fistname'] }}"
                                                readonly
                                            />
                                            <label>First Name</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['MI'] }}"
                                                readonly
                                            />
                                            <label>Middle Initial</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['Lastname'] }}"
                                                readonly
                                            />
                                            <label>Last Name</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['Course'] }}"
                                                readonly
                                            />
                                            <label>Course</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control"
                                                type="text"
                                                value="{{ $student['Year'] }}"
                                                readonly
                                            />
                                            <label>Year Level</label>
                                        </div>

                                    </form>

                                </div>

                                <div class="card-footer text-center py-3">

                                    <div class="small">
                                        <a href="register.html">
                                            Need an account? Sign up!
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

    <script src="{{ asset('dist/js/scripts.js') }}"></script>

</body>

</html>