<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use App\Models\Company;

class ListingOfferReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Listing $listing;
    public Offer $offer;
    public User $user;
    public Company $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Listing $listing, Offer $offer)
    {
        $this->listing = $listing;
        $this->offer = $offer;
        $this->user = $offer->user;
        $this->company = $offer->user->company;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ponuda za vaš oglas.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $signedUrl = URL::signedRoute('offer.accept', ['offer' => $this->offer->id]);
        return new Content(
            markdown: 'mail.listing_offer_received',
            with: [
                'listing' => $this->listing,
                'offer' => $this->offer,
                'company' => $this->company,
                'signedUrl' => $signedUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
