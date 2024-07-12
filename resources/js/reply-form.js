
    document.querySelectorAll('.reply-button').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            replyForm.classList.toggle('hidden');
        });
    });

    document.querySelectorAll('.show-replies-button').forEach(button => {
        button.addEventListener('click', () => {
            const commentId = button.dataset.commentId;
            document.getElementById(`replies-${commentId}`).classList.remove('hidden');
            button.classList.add('hidden');
            document.querySelector(`.hide-replies-button[data-comment-id="${commentId}"]`).classList.remove('hidden');
        });
    });

    document.querySelectorAll('.hide-replies-button').forEach(button => {
        button.addEventListener('click', () => {
            const commentId = button.dataset.commentId;
            document.getElementById(`replies-${commentId}`).classList.add('hidden');
            button.classList.add('hidden');
            document.querySelector(`.show-replies-button[data-comment-id="${commentId}"]`).classList.remove('hidden');
        });
    });
