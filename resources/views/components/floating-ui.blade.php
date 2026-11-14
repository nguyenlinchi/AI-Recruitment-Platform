<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ========================= -->
<!-- SCROLL TOP BUTTON -->
<!-- ========================= -->

<button id="scrollTopBtn" aria-label="Scroll to top">

    <svg xmlns="http://www.w3.org/2000/svg"
         width="24"
         height="24"
         fill="currentColor"
         viewBox="0 0 24 24">

        <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/>

    </svg>

</button>

<!-- ========================= -->
<!-- CHATBOT -->
<!-- ========================= -->

<button id="chatbot-toggle" aria-label="Mở chatbot">

    💬

</button>

<div id="chatbot-container">

    <!-- HEADER -->

    <div id="chatbot-header">

        <div class="bot-info">

            <div class="bot-avatar">
                🤖
            </div>

            <div>

                <div class="bot-title">
                    Chatbot Tuyển Dụng
                </div>

                <div class="bot-status">
                    Trực tuyến
                </div>

            </div>

        </div>

        <button id="chatbot-close">
            ✕
        </button>

    </div>

    <!-- CHAT -->

    <div id="chat"></div>

    <!-- INPUT -->

    <div id="controls">

        <input
            type="text"
            id="message"
            placeholder="Nhập tin nhắn..."
            autocomplete="off"
        >

        <button id="sendBtn">
            ➤
        </button>

    </div>

</div>

<style>

/* ========================= */
/* SCROLL BUTTON */
/* ========================= */

#scrollTopBtn{

    position: fixed;

    bottom: 90px;
    right: 28px;

    width: 50px;
    height: 50px;

    border: none;
    border-radius: 50%;

    background: linear-gradient(135deg,#f88705,#d46b00);

    color: white;

    cursor: pointer;

    z-index: 9997;

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow: 0 4px 15px rgba(248,135,5,.4);

    opacity: 0;

    pointer-events: none;

    transform: translateY(20px);

    transition: .35s;
}

#scrollTopBtn.show{

    opacity: 1;

    pointer-events: auto;

    transform: translateY(0);
}

#scrollTopBtn:hover{

    transform: translateY(-4px);

    background: linear-gradient(135deg,#f1d42e,#f88705);
}

/* ========================= */
/* CHATBOT BUTTON */
/* ========================= */

#chatbot-toggle{

    position: fixed;

    bottom: 20px;
    right: 20px;

    width: 60px;
    height: 60px;

    border: none;
    border-radius: 50%;

    background: linear-gradient(135deg,#b2d4ec,#8cb9dc);

    color: white;

    font-size: 24px;

    cursor: pointer;

    z-index: 9999;

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow: 0 6px 16px rgba(140,185,220,.5);

    transition: .3s;
}

#chatbot-toggle:hover{

    transform: scale(1.05);
}

/* ========================= */
/* CHATBOT CONTAINER */
/* ========================= */

#chatbot-container{

    position: fixed;

    bottom: 95px;
    right: 20px;

    width: 380px;
    height: 550px;

    background: white;

    border-radius: 20px;

    overflow: hidden;

    display: flex;
    flex-direction: column;

    box-shadow: 0 12px 40px rgba(140,185,220,.25);

    z-index: 9999;

    opacity: 0;

    pointer-events: none;

    transform: scale(.9) translateY(20px);

    transition: .35s;
}

#chatbot-container.active{

    opacity: 1;

    pointer-events: auto;

    transform: scale(1) translateY(0);
}

/* ========================= */
/* HEADER */
/* ========================= */

#chatbot-header{

    background: linear-gradient(135deg,#a7cdfa,#85b3e6);

    color: white;

    padding: 18px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bot-info{

    display: flex;
    align-items: center;
    gap: 10px;
}

.bot-avatar{

    width: 38px;
    height: 38px;

    border-radius: 50%;

    background: rgba(255,255,255,.25);

    display: flex;
    align-items: center;
    justify-content: center;
}

.bot-title{

    font-size: 15px;
    font-weight: 600;
}

.bot-status{

    font-size: 11px;
    opacity: .9;
}

#chatbot-close{

    border: none;
    background: transparent;

    color: white;

    cursor: pointer;

    font-size: 18px;
}

/* ========================= */
/* CHAT BODY */
/* ========================= */

#chat{

    flex: 1;

    padding: 18px;

    overflow-y: auto;

    background: #f4f8fb;

    display: flex;
    flex-direction: column;

    gap: 14px;
}

/* CUSTOM SCROLLBAR */

#chat::-webkit-scrollbar{

    width: 7px;
}

#chat::-webkit-scrollbar-track{

    background: #edf4fb;

    border-radius: 10px;
}

#chat::-webkit-scrollbar-thumb{

    background: linear-gradient(135deg,#b2d4ec,#8cb9dc);

    border-radius: 10px;
}

#chat::-webkit-scrollbar-thumb:hover{

    background: linear-gradient(135deg,#8cb9dc,#6fa3ce);
}

/* ========================= */
/* MESSAGE */
/* ========================= */

.msg{

    display: flex;
}

.msg.user{

    justify-content: flex-end;
}

.msg.bot{

    justify-content: flex-start;
}

.bubble{

    padding: 12px 16px;

    max-width: 75%;

    border-radius: 16px;

    font-size: 14px;

    line-height: 1.5;
}

.user .bubble{

    background: linear-gradient(135deg,#a0c9f0,#82b0dc);

    color: white;

    border-radius: 16px 16px 4px 16px;
}

.bot .bubble{

    background: #e6f0fa;

    color: #3a546e;

    border: 1px solid #d2e3f3;

    border-radius: 16px 16px 16px 4px;
}

/* ========================= */
/* INPUT */
/* ========================= */

#controls{

    display: flex;

    gap: 10px;

    padding: 14px;

    border-top: 1px solid #e1ecf5;

    background: white;
}

#message{

    flex: 1;

    border: 1px solid #d2e3f3;

    border-radius: 24px;

    padding: 12px 16px;

    outline: none;
}

#message:focus{

    border-color: #8cb9dc;
}

#sendBtn{

    width: 42px;
    height: 42px;

    border: none;
    border-radius: 50%;

    background: linear-gradient(135deg,#a0c9f0,#82b0dc);

    color: white;

    cursor: pointer;
}

</style>

<script>

document.addEventListener('DOMContentLoaded', function(){

    /* ========================= */
    /* SCROLL TOP */
    /* ========================= */

    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', function(){

        if(window.scrollY > 300){

            scrollBtn.classList.add('show');

        }else{

            scrollBtn.classList.remove('show');
        }
    });

    scrollBtn.addEventListener('click', function(){

        window.scrollTo({

            top: 0,

            behavior: 'smooth'
        });
    });

    /* ========================= */
    /* CHATBOT */
    /* ========================= */

    const chatbotContainer = document.getElementById('chatbot-container');

    const toggleBtn = document.getElementById('chatbot-toggle');

    const closeBtn = document.getElementById('chatbot-close');

    const chatDiv = document.getElementById('chat');

    const input = document.getElementById('message');

    const sendBtn = document.getElementById('sendBtn');

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

    toggleBtn.addEventListener('click', function(){

        chatbotContainer.classList.add('active');

        toggleBtn.style.display = 'none';

        if(chatDiv.children.length === 0){

            appendMessage(
                'Xin chào 👋 Tôi có thể hỗ trợ tìm việc cho bạn.',
                'bot'
            );
        }
    });

    closeBtn.addEventListener('click', function(){

        chatbotContainer.classList.remove('active');

        toggleBtn.style.display = 'flex';
    });

    function appendMessage(text, who){

        const row = document.createElement('div');

        row.className = 'msg ' + who;

        const bubble = document.createElement('div');

        bubble.className = 'bubble';

        bubble.textContent = text;

        row.appendChild(bubble);

        chatDiv.appendChild(row);

        chatDiv.scrollTop = chatDiv.scrollHeight;
    }

    async function sendMessage(){

        const msg = input.value.trim();

        if(!msg) return;

        appendMessage(msg,'user');

        input.value = '';

        try{

            const response = await fetch("{{ route('chat') }}",{

                method:'POST',

                headers:{
                    'Content-Type':'application/json',
                    'Accept':'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },

                body: JSON.stringify({
                    message: msg
                })
            });

            const data = await response.json();

            appendMessage(
                data.reply || 'Không có phản hồi',
                'bot'
            );

        }catch(error){

            appendMessage(
                'Có lỗi xảy ra.',
                'bot'
            );
        }
    }

    sendBtn.addEventListener('click', sendMessage);

    input.addEventListener('keypress', function(e){

        if(e.key === 'Enter'){

            sendMessage();
        }
    });

});

</script>