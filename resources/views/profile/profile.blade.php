@extends('layout.master')

@section('content')
    <div class="container-fluid">
        <div class="img-profile mb-3" style="position: relative; display: inline-block">
            <img
                src="{{ asset('storage/' . $user->image) }}"
                alt="Profile Image"
                class="rounded-circle"
                style="width: 150px; height: 150px"
            />
            <button
                class="btn rounded-circle"
                style="
                    position: absolute;
                    bottom: 0;
                    border: 3px solid #f3f2f2;
                    right: 0;
                    background-color: white;
                    transform: translate(20%, 20%);
                "
            >
                <i class="bi bi-pencil"></i>
            </button>
        </div>

        <div class="name-profile mb-4">
            <h2><strong>{{ $user->name }}</strong></h2>
        </div>

        <div class="container p-0">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="username" class="form-label">Nama Kandidat</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: transparent;">@</span>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            value="{{ $user->name }}"
                            readonly
                            style="border-left: none; color: #333"
                        />
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="position" class="form-label">Posisi Kandidat</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: transparent;">
                            <i class="bi bi-code-slash"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control"
                            id="position"
                            value="{{ $user->position }}"
                            readonly
                            style="border-left: none; color: #333"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
