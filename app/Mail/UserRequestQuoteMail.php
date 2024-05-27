<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserRequestQuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $requested_quote, public $file, public $user)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->user->email, $this->user->company_name),
            subject: $this->user->company_name . ' - has requested for an order.'
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.quote-request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if($this->file->file_path !== null){
            $filePath = $this->file->file_path;
        }
        else if($this->file->artwork !== null){
            $filePath = $this->file->artwork;
        }
        else {
            $filePath = $this->file->approval_file;
        }

        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $attachment = null;

        switch ($extension) {
            case 'pdf':
                $attachment = Attachment::fromStorage('/public/'. $filePath)
                    ->as('quote.pdf')
                    ->withMime('application/pdf');
                break;

            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                // Handle image attachments
                $attachment = Attachment::fromStorage('/public/' . $filePath)
                    ->as('quote_image.' . $extension)
                    ->withMime('image/' . $extension);
                break;

            // Add more cases for other document types if needed (e.g., doc, docx)

            default:
                // Handle unknown file types or provide a default attachment
                $attachment = Attachment::fromStorage('/public/' . $filePath)
                    ->as('unknown_file.' . $extension)
                    ->withMime(File::mimeType($filePath));
                break;
        }

        return [$attachment];
        // return [
        //     Attachment::fromStorage('/'.$this->file->file_path)
        //     ->as('quote.pdf')
        //     ->withMime('application/pdf'),
        // ];
    }
}
