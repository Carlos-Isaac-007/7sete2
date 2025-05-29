<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Certifique-se de que o PHPMailer está instalado
function get_ext($pdo,$fname)
{

	$up_filename=$_FILES[$fname]["name"];
	$file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extention
	$file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
	return $file_ext;
}

function ext_check($pdo,$allowed_ext,$my_ext) 
{

	$arr1 = array();
	$arr1 = explode("|",$allowed_ext);	
	$count_arr1 = count(explode("|",$allowed_ext));	

	for($i=0;$i<$count_arr1;$i++)
	{
		$arr1[$i] = '.'.$arr1[$i];
	}
	

	$str = '';
	$stat = 0;
	for($i=0;$i<$count_arr1;$i++)
	{
		if($my_ext == $arr1[$i])
		{
			$stat = 1;
			break;
		}
	}

	if($stat == 1)
		return true; // file extension match
	else
		return false; // file extension not match
}


function get_ai_id($pdo,$tbl_name) 
{
	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE '$tbl_name'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$next_id = $row['Auto_increment'];
	}
	return $next_id;
}
// FUNCAO QUE VAI GERAR NUMEROS ALEATORIA PARA SER iD
function randNumber(){
    $tamanho = rand(3, 10);
        $numero = 0;
        for ($i=0; $i < $tamanho; $i++) {
            $new_rand = rand(0, 9);
            $numero = $numero . $new_rand;
        }
        return $numero;
}
// funcao que vai calcular quanto tempo se passou desde que o usuario fez um pedido
function timeAgo($datetime) {
    $timestamp = strtotime($datetime); // Converte a data para timestamp
    $diff = time() - $timestamp; // Calcula a diferença entre o horário atual e a data fornecida

    if ($diff < 60) {
        return $diff . " segundos atrás";
    } elseif ($diff < 3600) {
        return floor($diff / 60) . " minutos atrás";
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . " horas atrás";
    } elseif ($diff < 2592000) {
        return floor($diff / 86400) . " dias atrás";
    } elseif ($diff < 31536000) {
        return floor($diff / 2592000) . " meses atrás";
    } else {
        return floor($diff / 31536000) . " anos atrás";
    }
}
// funcao que vai enviar o email com php mailer

function enviarEmail($destinatario, $nomeDestinatario, $assunto, $mensagem)
 {
    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Servidor SMTP da Hostinger
        $mail->SMTPAuth   = true;
        $mail->Username   = 'suporte@7setetech.com'; // Seu e-mail profissional
        $mail->Password   = 'Cliente7!'; // Sua senha de e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
        $mail->Port       = 465; // Porta SMTP (SSL: 465, TLS: 587)
        // Definições de Codificação
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        // Configuração do e-mail
        $mail->setFrom('suporte@7setetech.com', '7SeteTech');
        $mail->addAddress($destinatario, $nomeDestinatario);
        $mail->addReplyTo('suporte@7setetech.com', 'Suporte');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem);
        $mail->AltBody = strip_tags($mensagem); // Texto alternativo sem HTML

        // Enviar e-mail
        $mail->send();
        return "✅ E-mail enviado para $destinatario!";
    } catch (Exception $e) {
        return "❌ Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
function validarSenha($senha) {
    if (strlen($senha) < 4) {
        return "A senha deve ter pelo menos 4 caracteres.";
    }
   /* if (!preg_match('/[A-Za-z]/', $senha)) {
        return "A senha deve conter pelo menos uma letra.";
    }
    if (!preg_match('/[0-9]/', $senha)) {
        return "A senha deve conter pelo menos um número.";
    }
    if (!preg_match('/[\W_]/', $senha)) {
        return "A senha deve conter pelo menos um caractere especial.";
    }*/
    return null;
}

function validarTelefone($telefone) {
    if (!preg_match('/^\d{9}$/', $telefone)) {
        return "O número de telefone deve conter exatamente 9 dígitos numéricos.";
    }
    return null;
}

// rop imagem from de todos imagem


function cropImage($sourcePath, $destinationPath, $targetWidth, $targetHeight) {
    list($origWidth, $origHeight, $imageType) = getimagesize($sourcePath);

    // Criando a imagem a partir do tipo de arquivo
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            die("Formato de imagem não suportado.");
    }

    // Calcular a área de recorte (Crop Center)
    $aspectRatio = $origWidth / $origHeight;
    $targetRatio = $targetWidth / $targetHeight;

    if ($aspectRatio > $targetRatio) {
        // Cortar lateralmente
        $newWidth = $origHeight * $targetRatio;
        $newHeight = $origHeight;
        $x = ($origWidth - $newWidth) / 2;
        $y = 0;
    } else {
        // Cortar verticalmente
        $newWidth = $origWidth;
        $newHeight = $origWidth / $targetRatio;
        $x = 0;
        $y = ($origHeight - $newHeight) / 2;
    }

    // Criando a nova imagem cortada
    $croppedImage = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($croppedImage, $sourceImage, 0, 0, $x, $y, $targetWidth, $targetHeight, $newWidth, $newHeight);

    // Salvando a imagem final
    imagejpeg($croppedImage, $destinationPath, 90);

    // Liberando memória
    imagedestroy($sourceImage);
    imagedestroy($croppedImage);
}

// funcao que vai convert os valor em kz de verdade
function formatrKzemPhp($valor){
    $numero = preg_replace('/[^\d]/','',$valor);
    $fmt = new NumberFormatter('pt_AO', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($numero, 'AOA');
}

// deafaformatazr kz

function desformatarKz($valorFormatado) {
    // Remove tudo que não for número ou vírgula
    $valor = preg_replace('/[^\d,]/', '', $valorFormatado);

    // Remove os pontos separadores de milhar
    $valor = str_replace('.', '', $valor);

    // Ignora os centavos (parte decimal), se houver
    $valorSemCentavos = explode(',', $valor)[0];

    return (int) $valorSemCentavos;
}


function calcularEstimativa() {
    $agora = new DateTime();
    $hora = (int) $agora->format('H');
    $minuto = (int) $agora->format('i');

    // Horário de funcionamento: 08h00 às 18h00
    if ($hora >= 8 && $hora < 18) {
        return "Entrega: 10 - 35 minutos";
    } else {
        // Fora do horário, calcular tempo até 8h do próximo dia útil
        $proximaAbertura = clone $agora;
        
        if ($hora >= 18) {
            // Se for depois das 18h, move para o dia seguinte às 08h
            $proximaAbertura->modify('+1 day')->setTime(8, 0);
        } else {
            // Se for antes das 08h do mesmo dia
            $proximaAbertura->setTime(8, 0);
        }

        // Diferença em horas e minutos
        $intervalo = $agora->diff($proximaAbertura);
        $horasRestantes = (int)$intervalo->format('%h');
        $minutosRestantes = (int)$intervalo->format('%i');

        // Converter tudo para horas com decimal
        $tempoAteAbertura = $horasRestantes + ($minutosRestantes / 60);

        // Somar os 10–35 minutos (~0.17 a 0.58 horas)
        $estimativaMin = round($tempoAteAbertura + 0.17, 1);
        $estimativaMax = round($tempoAteAbertura + 0.58, 1);

        return "Entrega: $estimativaMin - $estimativaMax horas (entrega a partir das 08h)";
    }
}







