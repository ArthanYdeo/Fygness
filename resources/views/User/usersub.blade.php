@extends('layout.app')

@section('content')
<div class="container">
@if (!$hasActiveSubscription)
    <h2>Subscription Form</h2>
    <form action="{{ route('subscriptions.store') }}" method="POST" class="subscription-form">
        @csrf

        <div class="form-group">
            <label for="gym">Choose Gym:</label>
            <select name="gymname" id="gym" class="form-control">
                @foreach($gyms as $gym)
                    <option value="{{ $gym->name }}">{{ $gym->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subscription_type">Choose Subscription Type:</label>
            <select name="subscription_type" id="subscription_type" class="form-control" onchange="updateBenefits()">
                <option value="Basic1Month-1">Basic 1 Month</option>
                <option value="Basic3Months-3">Basic 3 Months</option>
                <option value="Basic5Months-5">Basic 5 Months</option>
            </select>
        </div>

        <div id="benefits" class="mt-4">
            <h4>Benefits:</h4>
            <ul id="benefits-list"></ul>
        </div>

        <button type="submit" class="btn btn-primary">Subscribe</button>
    </form>
@else
    <p>You have an active subscription. Subscription form is hidden.</p>
@endif
</div>
<script>
    const subscriptionBenefits = {
        'Basic1Month-1': [
            'Access to gym facilities',
            '1 free personal training session',
            'Free gym starter pack'
        ],
        'Basic3Months-3': [
            'Access to gym facilities',
            '3 free personal training sessions',
            'Free gym starter pack',
            '1 free nutrition consultation'
        ],
        'Basic5Months-5': [
            'Access to gym facilities',
            '5 free personal training sessions',
            'Free gym starter pack',
            '2 free nutrition consultations',
            '1 free massage session'
        ]
    };

    function updateBenefits() {
        const subscriptionType = document.getElementById('subscription_type').value;
        const benefitsList = document.getElementById('benefits-list');
        benefitsList.innerHTML = '';

        if (subscriptionBenefits[subscriptionType]) {
            subscriptionBenefits[subscriptionType].forEach(benefit => {
                const li = document.createElement('li');
                li.textContent = benefit;
                benefitsList.appendChild(li);
            });
        }
    }

    // Initialize the benefits list on page load
    document.addEventListener('DOMContentLoaded', updateBenefits);
</script>
@endsection
