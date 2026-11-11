<button class="save-job-btn {{ in_array($job->job_id, $savedJobIds ?? []) ? 'saved' : '' }}"
        data-job-id="{{ $job->job_id }}">

    <i class="{{ in_array($job->job_id, $savedJobIds ?? []) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>

</button>
