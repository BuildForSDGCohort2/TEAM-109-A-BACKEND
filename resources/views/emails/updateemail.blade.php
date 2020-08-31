Helloo {{$user->fname}} 
You Emaail was change, you need to verify the email, follow the link below
{{route('verify', $user->verification_token)}}