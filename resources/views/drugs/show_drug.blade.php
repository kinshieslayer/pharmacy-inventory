@include('subviews.header')

<div class="container">
    <div class="showdrug">
        <h1>{{ $drugs->name }}</h1>

        <div class="singledruginfo">
            <p><strong>Description:</strong> {{ $drugs->description }}</p>
            <p><strong>Quantity:</strong> {{ $drugs->quantity }}</p>
            <p><strong>Price:</strong> {{ $drugs->price }}</p>
            <p><strong>Expiry Date:</strong> {{ $drugs->expiry_date }}</p>
            <p><strong>Prescription Required:</strong> {{ $drugs->prescription_required ? 'Yes' : 'No' }}</p>
        </div>

        <div class="buttons">
            <a href="{{ route('showUpdateDrug', ['id' => $drugs->id]) }}">
                <button>Update</button>
            </a>

            <form method="POST" action="{{ route('deleteDrug', ['id' => $drugs->id]) }}">
                @csrf
                <button class="danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
