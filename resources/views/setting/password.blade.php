<form action="{{ route('setting.updatepassword') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    value="{{ old('password') }}" placeholder="Masukan password">
                @error('password')
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
