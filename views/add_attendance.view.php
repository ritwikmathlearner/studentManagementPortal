<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
        <label for="subject">Subject</label>
        <select name="subject" id="subject" class="form-control">
            <option value="">Select a subject</option>
            <?php foreach($data['subjects'] as $subject) : ?>
                <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['subjectError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="classDate">Class Date</label>
        <input type="date" name="classDate" value="<?= $data['classDate'] ?? ''?>" class="form-control" id="classDate" aria-describedby="classDateHelp">
        <small class="text-danger"><?= $data['classDateError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="lectureTitle">Lecture Title</label>
        <input type="text" name="lectureTitle" value="<?= $data['lectureTitle'] ?? ''?>" class="form-control" id="lectureTitle" aria-describedby="lectureTitleHelp">
        <small class="text-danger"><?= $data['lectureTitleError'] ?? '' ?></small>
    </div>
    <h4>Or Select Class</h4>
    <div class="form-group">
        <label for="attendance">Subject</label>
        <select name="attendance" id="attendance" class="form-control">
            <option value="">Select a attendance</option>
            <?php foreach($data['attendanceList'] as $attendance) : ?>
                <option value="<?= $attendance->id ?>"><?= $attendance->lecture_title ?> on <?= date_format(date_create($attendance->class_date), 'd/m/Y') ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $data['attendanceError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label>Select Students</label>
        <ul class="list-group">
            <?php foreach($data['students'] as $student) : ?>
                <li class="list-group-item">
                    <div class="form-check">
                        <input class="form-check-input" name="student[<?= $student->user_id ?>]" type="checkbox" value="<?= $student->user_id ?>" id="studentCheck<?= $student->user_id ?>">
                        <label class="form-check-label" for="defaultCheck1">
                            <?= $student->full_name ?>
                        </label>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <small class="text-danger"><?= $data['studentError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>