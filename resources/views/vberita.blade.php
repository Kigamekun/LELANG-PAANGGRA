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
                <th scope="col">Nama barang</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Harga Awal</th>
                <th scope="col">Deskripsi Barang</th>
                <th scope="col">Status Barang</th>

                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $key => $barang)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->tgl }}</td>
                    <td>{{ $barang->harga_awal }}</td>
                    <td>{{ $barang->deskripsi_barang }}</td>
                    <td>{{ $barang->status_barang }}</td>
                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-url="{{ route('barang.update', ['id' => $barang->id_barang]) }}"
                            data-nama_barang="{{ $barang->nama_barang }}"
                            data-tgl="{{ $barang->tgl }}"

                            data-harga_awal="{{ $barang->harga_awal }}"
                            data-deskripsi_barang="{{ $barang->deskripsi_barang }}"
                            data-status_barang="{{ $barang->status_barang }}"

                            >Update</button> | <button
                            onclick="deleteData('form{{ $barang->id_barang }}')" class="btn btn-danger">Delete</button></td>
                    <form id="form{{ $barang->id_barang }}" style="display: hidden"
                        action="{{ route('barang.delete', ['id' => $barang->id_barang]) }}" method="post">
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
                <form action="{{ route('barang.create', ['id' => 1]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                            <input type="date" name="tgl" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga Awal</label>
                            <input type="text" name="harga_awal" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi Barang</label>
                            <input type="text" name="deskripsi_barang" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <select name="status_barang" id="">
                                <option value="1">terbuka</option>
                                <option value="0">tertutup</option>

                            </select>
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
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" value="${$(e.relatedTarget).data('nama_barang')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                            <input type="date" name="tgl" class="form-control" value="${$(e.relatedTarget).data('tgl')}" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga Awal</label>
                            <input type="text" name="harga_awal" class="form-control" value="${$(e.relatedTarget).data('harga_awal')}" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi Barang</label>
                            <input type="text" name="deskripsi_barang" value="${$(e.relatedTarget).data('deskripsi_barang')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <select name="status_barang" id="">
                                <option value="1">terbuka</option>
                                <option value="0">tertutup</option>

                            </select>
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
