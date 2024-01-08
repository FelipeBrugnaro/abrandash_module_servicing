<x-admin.elements.input 
    name="icon" 
    :label="textLang('icon', 'servicing::lang.form')"
    type="file" 
    :value="$servicing->icon ?? old('icon')"
    accept=".png, .jpg, .jpeg">
    <small class="form-infos">
        {{ textLang('accepted_files') }}: .png .jpg and .jpeg
    </small>
</x-admin.elements.input>

<x-admin.elements.input 
    name="title" 
    :label="textLang('title', 'servicing::lang.form')"
    value="{{ $servicing->title ?? old('title') }}"
    required
    maxlength="255"
    minlength="3" />

<x-admin.elements.input 
    name="description" 
    :label="textLang('description', 'servicing::lang.form')"
    value="{{ $servicing->description ?? old('description') }}"
    required
    maxlength="255"
    minlength="3" />