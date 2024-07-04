<div class="w-full" x-data="{gradingModal : $wire.entangle('showModal')}" @keydown.window.escape="gradingModal = false"  aria-labelledby="grading-modal" x-ref="dialog" aria-modal="true">
    {{--GRADING MODAL--}}
    @include('member.grading-modal')
    <table class="min-w-full table leading-normal mt-8">
        <thead>
        <tr>
            <th
                class="px-5 py-3 rounded-l bg-gray-600 text-left
                                        text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Grade level
            </th>
            <th
                class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Grade date
            </th>
            <th
                class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Points to next
            </th>
            <th
                class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                Competition
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
        @each('member.grade-list', $grades, 'grade', 'member.empty-grade')
        </tbody>
    </table>

</div>
