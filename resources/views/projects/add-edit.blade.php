                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('name', $name)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea name="description" cols="60" rows="10">{{ old('description', $description)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Homepage</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="homepage" value="{{ old('homepage', $homepage)}}">
                            </div>
                        </div>
