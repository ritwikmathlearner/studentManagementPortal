<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype=multipart/form-data>
    <div class="form-group">
        <label for="assignment">Assignment</label>
        <select name="assignment" id="assignment" class="form-control">
            <option value="">Select a assginment</option>
            <?php foreach ($data['assignmentList'] as $assignment) : ?>
                <?php if (empty($assignment->file_name)) : ?>
                    <option value="<?= $assignment->id ?>" <?= isset($data['assignment']) && $assignment->id == $data['assignment'] ? 'selected' : '' ?>><?= $assignment->subject_name ?> - <?= $assignment->title ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['assignmentError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="solution">Solution</label>
        <input type="file" class="form-control-file" name="solution" id="solution">
        <small class="text-danger"><?= $data['solutionError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>