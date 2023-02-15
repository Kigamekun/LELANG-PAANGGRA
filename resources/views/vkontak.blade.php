@extends('layouts.base')

@section('content')
    <br>
    <div class="d-flex justify-content-end">


        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah
        </button> --}}

    </div>
    <br>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Barang</th>
                <th scope="col">Tgl Lelang</th>
                <th scope="col">Harga Akhir</th>
                <th scope="col">status</th>

                {{-- <th scope="col">Action</th> --}}

            </tr>
        </thead>
        <tbody>
            @foreach ($lelangs as $key => $lelang)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $lelang->id_barang }}</td>
                    <td>{{ $lelang->tgl_lelang }}</td>
                    <td>{{ $lelang->harga_akhir }}</td>
                    <td>{{ $lelang->status }}</td>

                    {{-- <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-url="{{ route('lelang.update', ['id' => $lelang->id_lelang]) }}"
                            data-id_barang="{{ $lelang->id_barang }}"
                            data-tgl_lelang="{{ $lelang->tgl_lelang }}"
                            data-harga_akhir="{{ $lelang->harga_akhir }}"
                            data-id_user="{{ $lelang->id_user }}"
                            data-id_petugas="{{ $lelang->id_petugas }}"
                            data-status="{{ $lelang->status }}"


                            >Update</button> | <button
                            onclick="deleteData('form{{ $lelang->id_lelang }}')" class="btn btn-danger">Delete</button></td>
                    <form id="form{{ $lelang->id_lelang }}" style="display: hidden"
                        action="{{ route('lelang.delete', ['id' => $lelang->id_lelang]) }}" method="post">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                </tr>
            @endforeach
        </tbody>
    </table>


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
                            <label for="exampleFormControlInput1" class="form-label">Id Barang</label>
                            <input type="text" name="id_barang" value="${$(e.relatedTarget).data('id_barang')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tgl Lelang</label>
                            <input type="date" name="tgl_lelang" value="${$(e.relatedTarget).data('tgl_lelang')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga Akhir</label>
                            <input type="text" name="harga_akhir" value="${$(e.relatedTarget).data('harga_akhir')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ID user</label>
                            <input type="text" name="id_user" value="${$(e.relatedTarget).data('id_user')}" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ID Petugas</label>
                            <input type="text" name="id_petugas" value="${$(e.relatedTarget).data('id_petugas')}" class="form-control" id="exampleFormControlInput1"
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
