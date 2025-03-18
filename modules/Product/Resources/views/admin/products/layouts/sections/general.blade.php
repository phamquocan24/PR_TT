<div class="box">
    <div class="box-header">
        <h5>{{ trans('product::products.group.general') }}</h5>
    </div>

    <div class="box-body">
        <div class="form-group row">
            <label for="name" class="col-sm-12 control-label text-left">
                {{ trans('product::attributes.name') }}
                <span class="text-red">*</span>
            </label>

            <div class="col-sm-12">
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                >
                <span class="help-block text-red">The name field is required</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-12 control-label text-left">
                {{ trans('product::attributes.description') }}
                <span class="text-red">*</span>
            </label>

            <div class="col-sm-12">
                <textarea
                    name="description"
                    id="description"
                    class="form-control wysiwyg"
                >
                </textarea>
                <span class="help-block text-red">The name field is required</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="brand-id" class="col-sm-12 control-label text-left">
                {{ trans('product::attributes.brand_id') }}
                <span class="text-red">*</span>
            </label>
            <div class="col-sm-6">
                <select name="brand_id" id="brand-id" class="form-control custom-select-black">
                    <option value="">Please Select</option>
                    <option value="8">ASUS</option>
                    <option value="7">Acer</option>
                    <option value="16">Adidas</option>
                    <option value="1">Apple</option>
                    <option value="15">Beats</option>
                    <option value="20">Bose</option>
                    <option value="6">Dell</option>
                    <option value="5">HP</option>
                    <option value="3">Huawei</option>
                    <option value="14">LG</option>
                    <option value="10">Lenovo</option>
                    <option value="12">MSI</option>
                    <option value="9">Microsoft</option>
                    <option value="17">NIKE</option>
                    <option value="19">NOKIA</option>
                    <option value="4">OnePlus</option>
                    <option value="11">Reebok</option>
                    <option value="18">SONY</option>
                    <option value="2">Samsung</option>
                </select>
                <span class="help-block text-red">The name field is required</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="categories" class="col-sm-12 control-label text-left">
                {{ trans('product::attributes.categories') }}
                <span class="text-red">*</span>
            </label>

            <div class="col-sm-6">
                <select name="categories" id="categories-id" class="form-control custom-select-black">
                    <option value="">Please Select</option>
                    <option value="8">ASUS</option>
                    <option value="7">Acer</option>
                    <option value="16">Adidas</option>
                    <option value="1">Apple</option>
                    <option value="15">Beats</option>
                    <option value="20">Bose</option>
                    <option value="6">Dell</option>
                    <option value="5">HP</option>
                    <option value="3">Huawei</option>
                    <option value="14">LG</option>
                    <option value="10">Lenovo</option>
                    <option value="12">MSI</option>
                    <option value="9">Microsoft</option>
                    <option value="17">NIKE</option>
                    <option value="19">NOKIA</option>
                    <option value="4">OnePlus</option>
                    <option value="11">Reebok</option>
                    <option value="18">SONY</option>
                    <option value="2">Samsung</option>
                </select>
                <span class="help-block text-red">The name field is required</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="is-active" class="col-sm-12 control-label text-left">
                {{ trans('product::attributes.is_active') }}
                <span class="text-red">*</span>
            </label>

            <div class="col-sm-9">
                <div class="switch">
                    <input type="checkbox" name="is_active" id="is-active">

                    <label for="is-active">
                        {{ trans('product::products.form.enable_the_product') }}
                    </label>

                    <span class="help-block text-red">The name field is required</span>
                </div>
            </div>
        </div>
    </div>
</div>
