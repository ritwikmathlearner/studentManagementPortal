<?php if(isset($data['success'])) : ?>
    <span class="bg-success text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['success'] ?></span>
<?php endif; ?>
<?php if(isset($data['fail'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['fail'] ?></span>
<?php endif; ?>
<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
        <label for="faculty_id">Faculty</label>
        <select name="faculty_id" id="faculty_id" class="form-control">
            <option value="">Select a Faculty</option>
            <?php foreach($data['faculties'] as $faculty) : ?>
                <option value="<?= $faculty->user_id ?>"><?= $faculty->full_name ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['facultyIdError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="faculty_id">Subject</label>
        <select name="subject_id" id="subject_id" class="form-control">
            <option value="">Select a Subject</option>
            <?php foreach($data['subjects'] as $subject) : ?>
                <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['subjectIdError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>