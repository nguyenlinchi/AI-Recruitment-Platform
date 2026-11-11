<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Chatbot AI</title>
  <style>
    #chat { width: 720px; max-width: 95%; margin: 20px auto; border: 1px solid #ddd; padding: 12px; border-radius:8px; background:#fff; }
    .msg { margin: 8px 0; display:flex; gap:8px; align-items:flex-start; }
    .user { justify-content:flex-end; }
    .user .bubble { background:#6C63FF; color:#fff; margin-left:auto; }
    .bot .bubble { background:#f1f3f5; color:#111; margin-right:auto; }
    .bubble { padding:8px 12px; border-radius:12px; max-width:80%; word-break:break-word; }
    #controls { width:720px; max-width:95%; margin: 8px auto; display:flex; gap:8px; }
    #message { flex:1; padding:8px 10px; border-radius:8px; border:1px solid #ccc; }
    #sendBtn { background:#6C63FF; color:#fff; border:none; padding:0 14px; border-radius:8px; cursor:pointer; }
    .small { font-size:0.85rem; color:#666; margin-left:6px; }
  </style>
</head>
<body>
  <h2 style="text-align:center; margin-top:18px;">🤖 Chatbot AI</h2>

  <div id="chat" aria-live="polite"></div>

  <div id="controls">
    <input id="message" type="text" placeholder="Nhập tin nhắn..." autocomplete="off" />
    <button id="sendBtn">Gửi</button>
  </div>

<script>
(function () {
  const chatDiv = document.getElementById('chat');
  const input = document.getElementById('message');
  const sendBtn = document.getElementById('sendBtn');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  function appendMessage(text, who) {
    const row = document.createElement('div');
    row.className = 'msg ' + (who === 'user' ? 'user' : 'bot');
    const bubble = document.createElement('div');
    bubble.className = 'bubble';
    bubble.textContent = text;
    row.appendChild(bubble);
    chatDiv.appendChild(row);
    chatDiv.scrollTop = chatDiv.scrollHeight;
  }

  function setUIBusy(busy = true) {
    input.disabled = busy;
    sendBtn.disabled = busy;
    if (busy) sendBtn.textContent = 'Đang...';
    else sendBtn.textContent = 'Gửi';
  }

  async function sendMessage() {
    const msg = input.value.trim();
    if (!msg) return;
    appendMessage(msg, 'user');
    input.value = '';
    setUIBusy(true);

    // show temporary bot "typing" bubble
    const typingRow = document.createElement('div');
    typingRow.className = 'msg bot';
    const typingBubble = document.createElement('div');
    typingBubble.className = 'bubble';
    typingBubble.textContent = '...';
    typingRow.appendChild(typingBubble);
    chatDiv.appendChild(typingRow);
    chatDiv.scrollTop = chatDiv.scrollHeight;

    try {
      const res = await fetch('/chat', {
        method: 'POST',
        credentials: 'same-origin', // send cookies (session) so CSRF works
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ message: msg })
      });

      if (!res.ok) {
        // show helpful message for common issues
        if (res.status === 419) {
          typingBubble.textContent = '⚠️ CSRF token mismatch (phiên đã hết). Load lại trang và thử lại.';
        } else {
          const text = await res.text();
          typingBubble.textContent = `⚠️ Lỗi server: ${res.status}`;
          console.error('Server body:', text);
        }
      } else {
        const data = await res.json();

        // Support multiple response formats (robust)
        let reply = null;
        if (data.reply) reply = data.reply;
        else if (data?.candidates?.[0]?.content?.parts?.[0]?.text) reply = data.candidates[0].content.parts[0].text;
        else if (data?.outputs?.[0]?.content?.text) reply = data.outputs[0].content.text;
        else if (typeof data === 'string') reply = data;

        typingBubble.textContent = reply || '⚠️ Không có phản hồi từ API.';
      }
    } catch (err) {
      console.error(err);
      typingBubble.textContent = '⚠️ Lỗi mạng. Kiểm tra console.';
    } finally {
      setUIBusy(false);
      chatDiv.scrollTop = chatDiv.scrollHeight;
    }
  }

  // Enter gửi (Shift+Enter xuống dòng)
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  sendBtn.addEventListener('click', sendMessage);
})();
</script>
</body>
</html>
