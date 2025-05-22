document.addEventListener('DOMContentLoaded', function () {
    const LIKE_BTN = document.getElementById('like-btn');

    if (LIKE_BTN) {
        LIKE_BTN.addEventListener('click', function () {
            const PRODUCT_ID = this.getAttribute('data-product-id');
            const URL = `/products/${PRODUCT_ID}/like`;
            const HEART_ICON = this.querySelector('i');
            const METHOD = HEART_ICON.style.color === 'red' ? 'DELETE' : 'POST';

            fetch(URL, {
                method: METHOD,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const likeCountSpan = document.getElementById('like-count');

                if (data.likes_count > 0) {
                    if (likeCountSpan) {
                        likeCountSpan.textContent = data.likes_count;
                    } else {
                        // spanがなければ新たに作成
                        const newSpan = document.createElement('span');
                        newSpan.id = 'like-count';
                        newSpan.textContent = data.likes_count;
                        this.parentNode.appendChild(newSpan);
                    }
                } else {
                    // いいねが0なら削除
                    if (likeCountSpan) {
                        likeCountSpan.remove();
                    }
                }

                // ハート色の切り替え
                HEART_ICON.style.color = METHOD === 'POST' ? 'red' : 'gray';
            });
        });
    }
});

