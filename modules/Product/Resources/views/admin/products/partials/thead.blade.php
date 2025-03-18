<tr>
    @include('admin::partials.table.select_all')

    <th data-dt-column="1" class="dt-orderable-asc dt-orderable-desc" style="width: 6%;">
        <span class="dt-column-title">{{ trans('admin::admin.table.id') }}</span>
        <span class="dt-column-order" role="button" tabindex="0"></span>
    </th>
    <th>{{ trans('product::products.table.thumbnail') }}</th>
    <th style="width: 32%;">{{ trans('product::products.table.name') }}</th>
    <th data-dt-column="1" class="dt-orderable-asc dt-orderable-desc" style="width: 16%;">
        <span class="dt-column-title">{{ trans('product::products.table.price') }}</span>
        <span class="dt-column-order" role="button" tabindex="0"></span>
    </th>
    <th data-dt-column="1" class="dt-orderable-asc dt-orderable-desc" style="width: 20px;">
        <span class="dt-column-title">{{ trans('product::products.table.stock') }}</span>
        <span class="dt-column-order" role="button" tabindex="0"></span>
    </th>
    <th data-dt-column="1" class="dt-orderable-asc dt-orderable-desc" style="width: 20px;">
        <span class="dt-column-title">{{ trans('admin::admin.table.status') }}</span>
        <span class="dt-column-order" role="button" tabindex="0"></span>
    </th>
    <th data-sort class="dt-orderable-asc dt-orderable-desc dt-ordering-desc">
        <span class="dt-column-title" role="button">Updated</span>
        <span class="dt-column-order"></span>
    </th>
</tr>
