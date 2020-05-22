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

php convert.php -i|--input diretório_dos_arquivos_txt -o|--output caminho_para_o arquivo_convertido -d|--debug

```

## Formatos suportados

### CSV: arquivos de texto com campos separados por ponto-e-vírgula (;).

Para usar esse formato, informe no parâmetro `--output caminho/arquivo.csv`, onde caminho/arquivo.csv será o diretório onde os arquivos CSV serão salvos.

Esse formato salva um arquivo CSV para cada arquivo TXT

## Agregação de dados

Os arquivos TXT do PAD geralmente são gerados para a Câmara de Vereadores e para o Poder Executivo, nestes incluídos o RPPS, e ainda outros para órgãos da administração indireta.

O comando `aggregate` faz a agregação dos dados de vários TXT em um único a fim de ter os dados de todo o município numa única base.

```sh

php aggregate.php diretório_de_destino diretório_de_origem_1 diretório_de_origem_2 diretório_de_origem_3 ...

```

## Changelog

### versão 0.2.0

- suporte a conversão para SQLite;
- comando aggregate adicionado;

### versão 0.1.0

- suporte para conversão para CSV;

## TODO

- salvar os metadados de cada arquivo;
