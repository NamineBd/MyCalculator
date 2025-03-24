<?php
// Initialisation de la variable d'affichage
$display = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn'])) {
        $button = $_POST['btn'];
        $display = isset($_POST['display']) ? $_POST['display'] : '';

        if ($button === 'C') {
            $display = '';
        } elseif ($button === '=') {
            // Évaluer l'expression mathématique
            try {
                // Remplace les fonctions scientifiques par leurs équivalents PHP
                $expression = $display;
                $expression = str_replace('sqrt', 'sqrt', $expression);
                $expression = str_replace('sin', 'sin', $expression);
                $expression = str_replace('cos', 'cos', $expression);
                $expression = str_replace('tan', 'tan', $expression);
                $expression = str_replace('log', 'log10', $expression);
                $expression = str_replace('exp', 'exp', $expression);
                $expression = str_replace('^', '**', $expression); // Puissance

                // Évalue l'expression
                $result = eval('return ' . $expression . ';');
                $display = $result;
            } catch (Throwable $e) {
                $display = 'Erreur';
            }
        } else {
            // Ajoute le bouton cliqué à l'affichage
            $display .= $button;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator">
        <form action="calculatrice.php" method="post">
            <input type="text" name="display" id="display" value="<?php echo htmlspecialchars($display); ?>" readonly>
            <div class="buttons">
                <!-- Boutons scientifiques et opérateurs -->
                <button type="submit" name="btn" value="C">C</button>
                <button type="submit" name="btn" value="(">(</button>
                <button type="submit" name="btn" value=")">)</button>
                <button type="submit" name="btn" value="/" class="operator">/</button>
                <button type="submit" name="btn" value="7">7</button>
                <button type="submit" name="btn" value="8">8</button>
                <button type="submit" name="btn" value="9">9</button>
                <button type="submit" name="btn" value="*" class="operator">*</button>
                <button type="submit" name="btn" value="4">4</button>
                <button type="submit" name="btn" value="5">5</button>
                <button type="submit" name="btn" value="6">6</button>
                <button type="submit" name="btn" value="-" class="operator">-</button>
                <button type="submit" name="btn" value="1">1</button>
                <button type="submit" name="btn" value="2">2</button>
                <button type="submit" name="btn" value="3">3</button>
                <button type="submit" name="btn" value="+" class="operator">+</button>
                <button type="submit" name="btn" value="0">0</button>
                <button type="submit" name="btn" value=".">.</button>
                <button type="submit" name="btn" value="sqrt">√</button>
                <button type="submit" name="btn" value="=" class="operator">=</button>
                <!-- Boutons supplémentaires pour les fonctions scientifiques -->
                <button type="submit" name="btn" value="sin">sin</button>
                <button type="submit" name="btn" value="cos">cos</button>
                <button type="submit" name="btn" value="tan">tan</button>
                <button type="submit" name="btn" value="log">log</button>
                <button type="submit" name="btn" value="exp">exp</button>
                <button type="submit" name="btn" value="^">^</button>
            </div>
        </form>
    </div>
</body>
</html>