<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bàn cờ {{ $n }}x{{ $n }}</title>
  <style>
    table { border-collapse: collapse; }
    td { width:30px; height:30px; text-align:center; }
    .black { background: #333; color: white; }
    .white { background: #fff; }
  </style>
</head>
<body>
  <h1>Bàn cờ {{ $n }} x {{ $n }}</h1>
  <table>
    @for ($i = 0; $i < $n; $i++)
      <tr>
        @for ($j = 0; $j < $n; $j++)
          @php $isBlack = ($i + $j) % 2 === 0; @endphp
          <td class="{{ $isBlack ? 'black' : 'white' }}"></td>
        @endfor
      </tr>
    @endfor
  </table>
</body>
</html>