<div class="w-full" x-data="{qualificationModal : $wire.entangle('showModal')}" @keydown.window.escape="qualificationModal = false" aria-labelledby="qualification-modal" x-ref="dialog" aria-modal="true">
    {{--QUALIFICATION EDIT MODAL--}}
    @include('member.qualification-modal')
    <table class="min-w-full table leading-normal mt-8">
        <thead>
        <tr>
            <th
                class="px-5 py-3 rounded-l bg-gray-600 text-left
                                        text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Level
            </th>
            <th
                class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Date attained
            </th>
            <th
                class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Notes
            </th>
            <th
                class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold
                                        text-gray-100
                                        uppercase tracking-wider">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        @each('member.qualification-list', $qualifications, 'qualification', 'member.empty-qualification')
        </tbody>
    </table>
</div>
