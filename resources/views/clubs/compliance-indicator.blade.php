{{-- Automatic club compliance indicator (CR26-001 R4a). Expects $club. --}}
@php
    $status = $club->complianceStatus();
    $expired = $club->expiredCertificates();
    $missing = $club->missingCertificates();
@endphp
<div class="w-full mt-2 mb-2">
    <span class="font-semibold text-gray-600 mr-2">Full compliance:</span>
    @if ($status === 'yes')
        <span class="green-pillow font-bold">YES</span>
    @elseif ($status === 'missing')
        <span class="orange-pillow font-bold">Missing data</span>
    @else
        <span class="red-pillow font-bold">NO</span>
    @endif
    @if ($club->hasNoLinkedPeople())
        <p class="mt-2 text-sm text-gray-600">No personnel, coaches or volunteers recorded.</p>
    @endif
    @if ($expired || $missing)
        <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            @foreach ($expired as $item)
                <li>{{ $item['person'] }} ({{ $item['role'] }}): {{ $item['certificate'] }} expired</li>
            @endforeach
            @foreach ($missing as $item)
                <li>{{ $item['person'] }} ({{ $item['role'] }}): {{ $item['certificate'] }} expiry date missing</li>
            @endforeach
        </ul>
    @endif
</div>
