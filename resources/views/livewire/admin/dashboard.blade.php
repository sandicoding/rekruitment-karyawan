<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <h4 class="card-title">{{$user}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-interface-6"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pelamar</p>
                                    <h4 class="card-title">{{$apply}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-secondary card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Lowongan</p>
                                    <h4 class="card-title">{{$job}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <span><i class="fas fa-address-card mr-3"></i>Lamaran Terbaru</span>
                        </h4>
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <td>Name</td>
                                    <td>No Hp</td>
                                    <td>Alamat</td>
                                    <td>Job</td>
                                    <td>status</td>
                                    <td>description</td>
                                    <td>file</td>
                                    <td>created at</td>
                                    <td>updated at</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($letest as $item)
                                <tr>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->no_telpon }}</td>
                                    <td>{{ $item->user->alamat }}</td>
                                    <td>{{ $item->job->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a class="btn btn-primary" href={{$item->file}} download>
                                            Download Berkas Pelamar
                                        </a>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-success btn-sm"
                                            href="{{ route('apply') }}"><i class="fas fa-edit"></i> Lihat List
                                        Lamaran</button> --}}
                                        <a class="btn btn-success btn-sm" href="{{ route('apply')}}">
                                            <i class="fas fa-address-card"></i>
                                            <p>Lihat List</p>
                                        </a>
                                        {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#confirm-modal" wire:click="getId('{{ $item->id }}')"
                                        id="btn-delete-{{ $item->id }}"><i class="fas fa-trash"></i></button> --}}
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
</div>
</div>


{{-- Modal form --}}
<div id="form-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">{{$update_mode ? 'Tambah' : 'Update'}} Data Karyawan
                </h5>
            </div>
            <div class="modal-body">
                {{-- <x-text-field type="number" name="id_user" label="id user" />
                        <x-text-field type="number" name="id_job" label="id job" /> --}}
                <x-select name="status" label="status">
                    <option value="">Select status</option>
                    <option value="menunggu">menunggu</option>
                    <option value="diterima">diterima</option>
                    <option value="ditolak">ditolak</option>

                </x-select>
                <x-textarea type="textarea" name="description" label="description" />
                {{-- <x-text-field type="text" name="file" label="file" /> --}}
                <x-text-field type="date" name="created_at" label="created at" />
                <x-text-field type="date" name="updated_at" label="updated at" />
            </div>
            <div class="modal-footer">
                <button type="button" wire:click={{$update_mode ? 'update' : 'store'}} class="btn btn-primary btn-sm"><i
                        class="fa fa-check pr-2"></i>Simpan</button>
                <button class="btn btn-danger btn-sm" wire:click='_reset'><i class="fa fa-times pr-2"></i>Batal</a>
            </div>
        </div>
    </div>
</div>


{{-- Modal confirm --}}
<div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin hapus data ini.?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i
                        class="fa fa-check pr-2"></i>Ya, Hapus</button>
                <button class="btn btn-primary btn-sm" wire:click='_reset'><i class="fa fa-times pr-2"></i>Batal</a>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')


<script>
    document.addEventListener('livewire:load', function(e) {
            window.livewire.on('showModal', (data) => {
                $('#form-modal').modal('show')
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
                $('#form-modal').modal('hide')
            });
        })
</script>
@endpush
