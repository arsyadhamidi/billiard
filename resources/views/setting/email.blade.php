<form action="{{ route('setting.updateemail') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label>Alamat Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $users->email ?? '-') }}" placeholder="Masukan alamat email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
