<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
        <label for="subject">Subject</label>
        <select name="subject" id="subject" class="form-control">
            <option value="">Select a subject</option>
            <?php foreach($data['subjectList'] as $subject) : ?>
                <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['subjectError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="assignment">Assignment Name</label>
        <input type="text" name="assignment" value="<?= $data['assignment'] ?? ''?>" class="form-control" id="assignment" aria-describedby="assignmentHelp">
        <small class="text-danger"><?= $data['assignmentError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="dueDate">Due Date</label>
        <input type="date" name="dueDate" min="<?= date('Y-m-d') ?>" value="<?= $data['dueDate'] ?? ''?>" class="form-control" id="dueDate" aria-describedby="dueDateHelp">
        <small class="text-danger"><?= $data['dueDateError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>