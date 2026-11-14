<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirper Dashboard</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        header {
            background-color: white;
            border-bottom: 1px solid #ddd;
            padding: 15px;
        }
        .navbar {
            max-width: 800px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }
        .navbar h1 {
            margin: 0;
            color: darkcyan;
            font-size: 1.5rem;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 15px;
        }
        .card {
            background-color: white;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font: inherit;
            resize: vertical;
        }
        textarea:focus { outline: 2px solid #93c5fd; }
        button {
            padding: 9px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font: inherit;
        }
        .btn-primary, .btn-danger, .btn-edit {
            background-color: darkcyan;
            color: white;
        }
        .chirp-header {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }
        .chirp-message {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            line-height: 1.5;
        }
        .chirp-date { color: #6b7280; font-size: 13px; }
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        .actions form { margin: 0; }
        .edit-form { margin-top: 15px; }
        .edit-form[hidden] { display: none; }
        .success { color: #166534; }
        .error { color: #b91c1c; }
        .form-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }
        .empty-state { color: #6b7280; }
        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .container { margin: 15px auto; }
            .card { padding: 15px; }
            .form-footer { justify-content: stretch; }
            .form-footer button { width: 100%; }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Chirper</h1>
            <div class="user-info">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="container">
        <h2>Latest Chirps</h2>

        @if (session('success'))
            <p class="success" role="status">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <ul class="error" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <section class="card" aria-labelledby="create-heading">
            <h3 id="create-heading">What's on your mind?</h3>
            <form method="POST" action="{{ route('chirps.store') }}">
                @csrf
                <label for="new-message">Your message</label>
                <textarea id="new-message" name="message" rows="3" maxlength="255"
                    placeholder="Write your chirp here..." required>{{ old('message') }}</textarea>
                <div class="form-footer">
                    <button type="submit" class="btn-primary">Chirp</button>
                </div>
            </form>
        </section>

        @forelse ($chirps as $chirp)
            <article class="card">
                <div class="chirp-header">
                    <strong>{{ $chirp->user->name }}</strong>
                    <time class="chirp-date" datetime="{{ $chirp->created_at->toIso8601String() }}">
                        {{ $chirp->created_at->diffForHumans() }}
                    </time>
                </div>
                <p class="chirp-message">{{ $chirp->message }}</p>

                @if (auth()->id() === $chirp->user_id)
                    <div class="actions">
                        <button type="button" class="btn-edit edit-button"
                            data-id="{{ $chirp->id }}"
                            aria-expanded="false" aria-controls="edit-{{ $chirp->id }}">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </div>

                    <div id="edit-{{ $chirp->id }}" class="edit-form" hidden>
                        <form method="POST" action="{{ route('chirps.update', $chirp) }}">
                            @csrf
                            @method('PUT')
                            <label for="message-{{ $chirp->id }}">Edit your chirp</label>
                            <textarea id="message-{{ $chirp->id }}" name="message" rows="3"
                                maxlength="255" required>{{ $chirp->message }}</textarea>
                            <div class="form-footer">
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                @endif
            </article>
        @empty
            <div class="card">
                <p class="empty-state">No chirps yet. Be the first to chirp!</p>
            </div>
        @endforelse
    </main>

    <script>
        document.querySelectorAll('.edit-button')
            .forEach(function (button) {
                button.addEventListener('click', function () {
                    const editForm = document.getElementById('edit-' + button.dataset.id);

                    if (editForm) {
                        editForm.hidden = !editForm.hidden;
                        button.setAttribute('aria-expanded', String(!editForm.hidden));
                    }
                });
            });

        document.querySelectorAll('.delete-form')
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!confirm('Delete this chirp?')) {
                        event.preventDefault();
                    }
                });
            });
    </script>
</body>
</html>
