<div {{ $attributes->merge([
    'class' => 'prose max-w-full prose-invert',
]) }}>
    {!! $slot !!}
</div>
