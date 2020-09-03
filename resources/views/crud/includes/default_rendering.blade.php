@push('js')
    <script language="javascript">
        $(document).ready(function () {
            $('#datatable-1').dt({
                columns: {!! json_encode($columns) !!},
                extraColumns: {
                    manage: [
                        {
                            name: 'edit',
                            route: '{{ route($entityName . '.updateForm', ['id' => '|id|']) }}'
                        },
                        {
                            name: 'delete',
                            route: '{{ route($entityName . '.destroy', ['id' => '|id|']) }}'
                        },
                    ]
                },
            })
        })
    </script>
@endpush
