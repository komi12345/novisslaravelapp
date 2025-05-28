<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4A90E2;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .field {
            margin-bottom: 15px;
        }
        .field strong {
            display: block;
            margin-bottom: 5px;
        }
        .message {
            white-space: pre-wrap;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nouveau message de contact</h1>
    </div>
    
    <div class="content">
        <p>Un nouveau message a été envoyé depuis le formulaire de contact du site Novis Togo.</p>
        
        <div class="field">
            <strong>Nom:</strong>
            {{ $data['name'] }}
        </div>
        
        <div class="field">
            <strong>Email:</strong>
            {{ $data['email'] }}
        </div>
        
        @if(isset($data['subject']) && !empty($data['subject']))
        <div class="field">
            <strong>Sujet:</strong>
            {{ $data['subject'] }}
        </div>
        @endif
        
        <div class="field">
            <strong>Message:</strong>
            <div class="message">{{ $data['message'] }}</div>
        </div>
    </div>
    
    <div class="footer">
        <p>Ce message a été envoyé automatiquement depuis le site web de Novis Togo.</p>
    </div>
</body>
</html>