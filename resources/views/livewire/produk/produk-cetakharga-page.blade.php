<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Cetak Harga</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">cetak harga</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-2">

                    <button type="button" wire:click="cetakSemua()" class="btn btn-primary rounded-pill">
                        Cetak semua
                    </button>
                    <button type="button" wire:click="resetAll()" class="btn ml-2 px-4 btn-danger rounded-pill">
                        Reset
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cetak Harga</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="w-100">Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                {{ $data->produk->nama }}
                                            </td>
                                            <td>
                                                <button
                                                {{-- onclick="confirm('Hapus dari daftar cetak?') || event.stopImmediatePropagation()" --}}
                                                wire:click="hapus('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
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
        </section>
    </div>
</div>


<style>
    .card-text {
        font-size: 14px;
    }

</style>


@push('script')
    <script>

    Livewire.on('cetakData', data => {
        console.log(data.url);
        console.log(data.title);

        cetakStruk(data.url, data.title);

    })

        function cetakStruk(url, title) {
            // popupCenter(url, title, 720, 675);
            popupCenter(url, title, 900, 700);
        }

        function popupCenter(url, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;
            var myWindow = window.open(url, title,
            'resizable=yes, width=' + w + ', height=' + h + ', top='
            + top + ', left=' + left);
        }


</script>

@endpush
