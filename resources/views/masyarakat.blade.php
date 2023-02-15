@extends('layouts.base')

@section('content')
    <br>
    <div class="d-flex justify-content-end">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah
        </button>

    </div>
    <br>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama masyarakat</th>
                <th scope="col">Username</th>
                <th scope="col">Telphone</th>


                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakats as $key => $masyarakat)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $masyarakat->nama_lengkap }}</td>
                    <td>{{ $masyarakat->username }}</td>
                    <td>{{ $masyarakat->telp }}</td>

                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-url="{{ route('masyarakat.update', ['id' => $masyarakat->id]) }}"
                            data-nama_lengkap="{{ $masyarakat->nama_lengkap }}"
                            data-username="{{ $masyarakat->username }}"
                            data-telp="{{ $masyarakat->telp }}"

                            >Update</button> | <button
                            onclick="deleteData('form{{ $masyarakat->id }}')" class="btn btn-danger">Delete</button></td>
                    <form id="form{{ $masyarakat->id }}" style="display: hidden"
                        action="{{ route('masyarakat.delete', ['id' => $masyarakat->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('masyarakat.create', ['id' => 1]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Telphone</label>
                            <input type="text" name="telp" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script>
        $('#updateModal').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Modal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="${$(e.relatedTarget).data('url')}" method="POST">
        @csrf
        <div class="modal-body">



            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="${$(e.relatedTarget).data('nama_lengkap')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="${$(e.relatedTarget).data('username')}" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Telphone</label>
                            <input type="text" name="telp" class="form-control" id="exampleFormControlInput1" value="${$(e.relatedTarget).data('telp')}"
                                placeholder="name@example.com">
                        </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

`;

            $('#modal-content').html(html);

        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteData(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                timer: 3000,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success',
                        text: "Your data has been deleted",
                        icon: 'success',
                        timer: 2000,
                    })
                    setTimeout(() => {
                        console.log('ada');
                        $('#' + id).submit();
                    }, 2015);
                }
            })
        }
    </script>


    @if (!is_null(Session::get('message')))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: @json(Session::get('status')),
                title: @json(Session::get('status')),
                html: @json(Session::get('message')),
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
@endsection
