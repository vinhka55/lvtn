<style>
  #btn-help {
    background: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
  }
  button {
    cursor: pointer;
    border: none;
  }
  #chatbot-box {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 300px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-family: Arial;
    overflow: hidden;
    z-index: 999;
  }

  #chatbot-header {
    background: #007bff;
    color: white;
    padding: 10px;
    font-weight: bold;
    cursor: pointer;
  }

  #chatbot-body {
    max-height: 250px;
    overflow-y: auto;
    padding: 10px;
    font-size: 14px;
  }

  #chatbot-input-area {
    display: flex;
    border-top: 1px solid #ddd;
  }

  #chatbot-input {
    flex: 1;
    border: none;
    padding: 10px;
    outline: none;
  }

  #chatbot-send {
    border: none;
    background: #007bff;
    color: white;
    padding: 10px 15px;
    cursor: pointer;
  }

  .bot-message {
    background: #f1f1f1;
    padding: 8px;
    border-radius: 5px;
    margin-bottom: 8px;
  }

  .user-message {
    background: #007bff;
    color: white;
    padding: 8px;
    border-radius: 5px;
    text-align: right;
    margin-bottom: 8px;
  }
</style>

<div id="chatbot-box">
  <div id="chatbot-header">💬 Hỗ trợ khách hàng</div>
  <div id="chatbot-body">
    <button id="btn-help" onclick="sendQuestion(this)">Help</button>
  </div>
  <div id="chatbot-input-area">
    <input type="text" id="chatbot-input" placeholder="Bạn cần hỗ trợ gì?..." />
    <button id="chatbot-send">Gửi</button>
  </div>
</div>

<script>
    $('#chatbot-input').keypress(function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault(); 
            let question = $(this).val();
            $('#chatbot-body').append(`<div class="chat-message user">${question}</div>`);
            $(this).val('');

            $.ajax({
                url: "{{route('send_question')}}",
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { question },
                success: function(response) {
                    $('#chatbot-body').append(`<div class="chat-message bot">${response.answer}</div>`);
                }
            });
        }
    });
    const chatbotHeader = document.getElementById('chatbot-header');
    const chatbotBody = document.getElementById('chatbot-body');
    const chatbotInputArea = document.getElementById('chatbot-input-area');

    let isCollapsed = false;

    chatbotHeader.addEventListener('click', () => {
      isCollapsed = !isCollapsed;
      chatbotBody.style.display = isCollapsed ? 'none' : 'block';
      chatbotInputArea.style.display = isCollapsed ? 'none' : 'flex';

      // Đổi tiêu đề kèm icon nếu muốn
      chatbotHeader.innerText = isCollapsed ? '💬 Mở lại hỗ trợ' : '💬 Hỗ trợ khách hàng';
    });
    
    function sendQuestion(buttonElement){
      let question = buttonElement.innerText || buttonElement.textContent;
      
      $.ajax({
                url: "{{route('send_question')}}",
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { question },
                success: function(response) {
                    $('#chatbot-body').append(`<div class="chat-message bot">${response.answer}</div>`);
                    // console.log(response.answer);
                    
                }
            });
    }
    
</script>
<script>
      $(document).on("submit", "#shipping-form", function (e) {
          e.preventDefault();
          $.ajax({
              url: "{{route('edit_shipping')}}",
              method: 'POST',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              data: $(this).serialize(),
              success: function(data) {            
                alert(data.message);
                // $("#shipping-result").css("color", "red").text(data.message);
              },
              error: function(xhr, status, error) {
                  console.error("Lỗi:", error);
                  alert("Đã có lỗi xảy ra!");
              }
          });
      });
  </script>
