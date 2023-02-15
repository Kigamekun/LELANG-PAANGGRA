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
                <th scope="col">ID Lelang </th>
                <th scope="col">ID User</th>
                <th scope="col">Penawaran Harga</th>
                {{-- <th scope="col">Action</th> --}}

            </tr>
        </thead>
        <tbody>
            @foreach ($historys as $key => $history)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $history->id_lelang }}</td>
                    <td>{{ $history->id_user }}</td>
                    <td>{{ $history->penawaran_harga }}</td>
                    {{-- <td> --}}
                        {{-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-url="{{ route('history.update', ['id' => $history->id_history]) }}"
                            data-id_lelang="{{ $history->id_lelang }}" data-id_user="{{ $history->id_user }}"
                            data-penawaran_harga="{{ $history->penawaran_harga }}">Update</button> | <button
                            onclick="deleteData('form{{ $history->id_history }}')" class="btn btn-danger">Delete</button>
                    </td>
                    <form id="form{{ $history->id_history }}" style="display: hidden"
                        action="{{ route('history.delete', ['id' => $history->id_history]) }}" method="post">
                        @csrf
                        @method('DELETE')
                    </form> --}}
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
                <form action="{{ route('history.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Penawaran Harga</label>
                            <input type="text" name="penawaran_harga" class="form-control" placeholder="Penawaran Harga">
                        </div>
                        <div class="mb-3">
                            <select name="id_lelang" id="" class="form-select">
                                <option value="" selected>Select your lelang</option>
                                @foreach (DB::table('tb_lelang')->get() as $item)
                                    <option value="{{ $item->id_lelang }}">{{ $item->id_lelang }}</option>
                                @endforeach
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
                <label for="exampleFormControlInput1" class="form-label">Nama history</label>
                <input type="text" name="nama_history" value="${$(e.relatedTarget).data('nama_history')}" class="form-control" id="exampleFormControlInput1"
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
