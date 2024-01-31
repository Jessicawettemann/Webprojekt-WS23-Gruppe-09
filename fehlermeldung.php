
<?php
function displayMessage($message, $messageType) {
    echo "<div class='message-box $messageType-message' id='messageBox'>";
    echo "<p>$message</p>";
    echo "</div>";
    echo "<style>
            .message-box {
                width: 300px;
                margin: 20px auto;
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Hinzugefügter Schatten */
            }

            .fine-message {
                background-color: #d4edda;
                color: #155724;
            }

            .fail-message {
                background-color: #f8d7da;
                color: #721c24;
            }
          </style>";
}
?>