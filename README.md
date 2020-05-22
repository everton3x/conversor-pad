# Conversor do PAD

Conversor de dados armazenados em arquivos de texto com campos de largura fixa conforme layout do TCE/RS para importação no sistema SIAPC/PAD.

---

## Requisitos

- PHP 7
- Composer

Para requisitos detalhados, veja o arquivo composer.json

## Instalação

```sh

git clone https://github.com/everton3x/conversor-pad.git

cd conversor-pad

composer install

```

## Utilização

```sh

php convert.php -i|--input diretório_dos_arquivos_txt -o|--output caminho_para_o arquivo_convertido

```

## Formatos suportados

### CSV: arquivos de texto com campos separados por ponto-e-vírgula (;).

Para usar esse formato, informe no parâmetro `--output caminho/arquivo.csv`, onde caminho/arquivo.csv será o diretório onde os arquivos CSV serão salvos.

Esse formato salva um arquivo CSV para cada arquivo TXT

## Changelog

### versão 0.1.3

- suporte para conversão para CSV;

## TODO

### versão 0.2.0

- suporte a conversão para SQLite;
- salvar os metadados de cada arquivo;

### sem versão definida
