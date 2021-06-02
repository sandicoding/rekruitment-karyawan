<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
            <a href="{{route('dashboard')}}">
              <span><i class="fas fa-arrow-left mr-3"></i>Log Absensi</span>
            </a>
          </h4>
        </div>
      </div>
    </div>

    {{-- <div class="col-md-12">
      <div class="card">
        <div class="row">
          <div class="col-md-3">
            <x-text-date type="date" name="tgl_mulai" label="Tanggal Mulai" />
          </div>
          <div class="col-md-3">
            <x-text-date type="date" name="tgl_selesai" min="{{$tgl_mulai}}" label="Tanggal Selesai" />
  </div>
</div>
</div>
</div> --}}

<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <td>Nama Karyawan</td>
            <td>Waktu Absen</td>
            <td>Jenis Absen</td>
            <td>Status Absen</td>
            <td>Keterangan</td>
            <td>Foto</td>
            {{-- <td>Action</td> --}}

          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td>
            </td>
            <td>

              <button class="btn btn-success btn-sm">ONTIME</button>

              <button class="btn btn-danger btn-sm">TELAT</button>

            </td>
            <td></td>
            <td></td>
            {{-- <td>
                  <button class="btn btn-success btn-sm" wire:click="getDataById('{{ $item->id }}')"
            id="btn-edit-{{ $item->id }}"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-modal"
              wire:click="getId('{{ $item->id }}')" id="btn-delete-{{ $item->id }}"><i
                class="fas fa-trash"></i></button>
            </td> --}}
          </tr>

        </tbody>
      </table>
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
        <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i class="fa fa-check pr-2"></i>Ya,
          Hapus</button>
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
</div>