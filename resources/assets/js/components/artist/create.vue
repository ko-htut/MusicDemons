<template>
    <div>
        <div class="form-group row">
            <div class="col-12">
                <h4 class="d-inline-block">Create artist</h4>
                <span class="float-right">
                    <button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create artist
					</button>
                </span>
            </div>
        </div>
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-xl-2">Artist name</label>
            <div class="col-sm-8 col-xl-10">
                <input type="text" class="form-control" name="name" id="name" value="" placeholder="" required="" autofocus="">
            </div>
        </div>
    		<div class="form-group row">
            <label for="year_started" class="col-sm-4 col-xl-2">Year started</label>
            <div class="col-sm-8 col-xl-10">
                <input type="text" class="form-control" name="year_started" id="year_started" value="" placeholder="" required="">
            </div>
        </div>		
        <div class="form-group row">
            <label for="year_quit" class="col-sm-4 col-xl-2">Year quit</label>
            <div class="col-sm-8 col-xl-10">
                <input type="text" class="form-control" name="year_quit" id="year_quit" value="" placeholder="">
            </div>
        </div>
		<div class="form-group row">
			<label for="members" class="col-sm-4 col-xl-2">Members</label>
			<div class="col-sm-8 col-xl-10">
				<select class="form-control select2" name="members" id="members" data-placeholder="Members" data-url="https://lyricdb.tk/autocomplete/all/" multiple>
				</select>
			</div>
		</div>
    </div>
</template>

<script type="text/babel">
</script>