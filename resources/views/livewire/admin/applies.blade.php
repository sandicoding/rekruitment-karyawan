<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>Daftar Lamaran</span>
                        </a>
                        <div class="pull-right">
                            @if (!$form && !$modal)
                            <button class="btn btn-danger btn-sm" wire:click="toggleForm(false)"><i
                                    class="fas fa-times"></i> Cancel</button>
                            @else
                            <button class="btn btn-primary btn-sm"
                                wire:click="{{$modal ? 'showModal' : 'toggleForm(true)'}}"><i class="fas fa-plus"></i>
                                Add
                                New</button>
                            @endif
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
                            @foreach ($items as $item)
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
                                    <button class="btn btn-success btn-sm" wire:click="getDataById('{{ $item->id }}')"
                                        id="btn-edit-{{ $item->id }}"><i class="fas fa-edit"></i> Tanggapi
                                        Lamaran</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-modal" wire:click="getId('{{ $item->id }}')"
                                        id="btn-delete-{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <button type="button" wire:click={{$update_mode ? 'update' : 'store'}}
                            class="btn btn-primary btn-sm"><i class="fa fa-check pr-2"></i>Simpan</button>
                        <button class="btn btn-danger btn-sm" wire:click='_reset'><i
                                class="fa fa-times pr-2"></i>Batal</a>
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
                        <button class="btn btn-primary btn-sm" wire:click='_reset'><i
                                class="fa fa-times pr-2"></i>Batal</a>
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
</div>