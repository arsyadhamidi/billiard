<form action="{{ route('setting.updategambar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleInputFile">Photo Profil</label>
                    <div class="custom-file">
                        <input type="file" name="foto_profile"
                            class="custom-file-input @error('foto_profile') is-invalid @enderror" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose
                            file</label>
                        @error('foto_profile')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Simpan Data
            </button>
        </div>
    </div>
</form>
