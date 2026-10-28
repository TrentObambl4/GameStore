@extends('layouts.app')

@section('content')

<div class="dashboard">

    <div class="dashboard-header">

        <div>

            <span class="section-label">ADMIN</span>

            <h1>Пользователи</h1>

            <p>
                Управление ролями пользователей.
            </p>

        </div>

        <a href="{{ route('admin.index') }}" class="btn btn-dark">
            ← Игры
        </a>

    </div>


    @if (session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="users-list">

        @foreach ($users as $user)

            <div class="user-row">

                <div class="user-info">

                    <strong>
                        {{ $user->login }}
                    </strong>

                    <span>
                        Текущая роль:
                        {{ $user->role->name }}
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.user.role', $user) }}"
                    class="role-form"
                >

                    @csrf
                    @method('PUT')

                    <select name="role_id">

                        @foreach ($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected($user->role_id == $role->id)
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>


                    <button type="submit" class="btn btn-small">
                        Сохранить
                    </button>

                </form>

            </div>

        @endforeach

    </div>

</div>

@endsection
