<?php
    // Controlla se i campi sono definiti
    $originalParagraph = isset($_GET['paragraph']) ? $_GET['paragraph'] : '';
    $badword = isset($_GET['badword']) ? $_GET['badword'] : '';
    $censoredParagraph = $originalParagraph;

    // Sostituisce la parola solo se fornita
    if ($badword !== '') {
        $censoredParagraph = str_replace($badword, '***', $originalParagraph);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Censorship</title>
    </head>
    <body>
        <header>
            <h1>
                Censorship
            </h1>
        </header>
        <main>
            <form action="?" method="get">
                <div>
                    <div>
                        <label for="">Testo da modificare</label>
                    </div>
                    <textarea name="paragraph" id="paragraph"placeholder="Inserisci il testo ..."></textarea>
                </div>
                <div>
                    <div>
                        <label for="badword">Parola da censurare</label>
                    </div>
                    <input type="text" name="badword" id="badword" placeholder="Inserisci parola da censurare...">
                </div>
                <div>
                    <button type="submit">
                        Invia
                    </button>
                </div>
            </form>
            <?php if ($originalParagraph !== '' || $badword !== ''): ?>
                <div>
                    <h2>Testo originale:</h2>
                    <p><?php echo $originalParagraph; ?></p>
                </div>
                <hr>
                <div>
                    <h2>Testo modificato:</h2>
                    <p><?php echo $censoredParagraph; ?></p>
                </div>
                <?php if ($badword !== ''): ?>
                    <div>
                        <h3>Parola censurata: <?php echo $badword; ?></h3>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </main>
    </body>
</html>
