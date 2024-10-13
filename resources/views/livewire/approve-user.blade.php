<div>
    <p>simple admin pannel for approving users</p>

    @foreach ($this->notApprovedUsers as $user)
        <h2>{{ $user->name }}</h2><br>
    @endforeach
</div>
