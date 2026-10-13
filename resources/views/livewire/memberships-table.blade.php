<div class="w-full mt-8 memberships-table">
    {{-- Make the actively sorted column obvious: tinted header, bold label, larger chevron. --}}
    <style>
        .memberships-table th[aria-sort] {
            background-color: rgb(224 231 255);
            box-shadow: inset 0 -3px 0 rgb(79 70 229);
        }
        .memberships-table th[aria-sort] .fi-ta-header-cell-label {
            color: rgb(55 48 163);
            font-weight: 700;
        }
        .memberships-table th[aria-sort] .fi-ta-header-cell-sort-icon {
            color: rgb(79 70 229);
            width: 1.5rem;
            height: 1.5rem;
        }
        @media (prefers-color-scheme: dark) {
            .memberships-table th[aria-sort] { background-color: rgb(49 46 129); }
            .memberships-table th[aria-sort] .fi-ta-header-cell-label { color: #fff; }
            .memberships-table th[aria-sort] .fi-ta-header-cell-sort-icon { color: rgb(165 180 252); }
        }
    </style>

    {{ $this->table }}
</div>
