<h2>New Contact Message</h2>

<p><strong>Name:</strong> {{ $formData['name'] }}</p>
<p><strong>Email:</strong> {{ $formData['email'] }}</p>
<p><strong>Phone:</strong> {{ $formData['phone'] ?? 'Not Provided' }}</p>
<p><strong>Subject:</strong> {{ $formData['subject'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $formData['message'] }}</p>
