<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="name" value="{{ old('name', $project->name)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Acronym</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="acronym" value="{{ old('acronym', $project->acronym)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Type</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="type" value="{{ old('type', $project->type)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Theme</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="theme" value="{{ old('theme', $project->theme)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Keywords</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="keywords" value="{{ old('keywords', $project->keywords)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Used Software</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="used_software" value="{{ old('used_software', $project->used_software)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Used Hardware</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="used_hardware" value="{{ old('used_hardware', $project->used_hardware)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Observations</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="observations" value="{{ old('observations', $project->observations)}}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Description</label>
    <div class="col-md-6">
        <textarea name="description" cols="60" rows="10">{{ old('description', $project->description)}}</textarea>
    </div>
</div>
